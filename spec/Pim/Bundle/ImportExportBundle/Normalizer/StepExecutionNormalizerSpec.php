<?php

namespace spec\Pim\Bundle\ImportExportBundle\Normalizer;

use Akeneo\Component\Batch\Model\StepExecution;
use Akeneo\Component\Batch\Model\Warning;
use Akeneo\Component\Batch\Job\BatchStatus;
use Doctrine\Common\Collections\ArrayCollection;
use PhpSpec\ObjectBehavior;
use Pim\Component\Localization\Presenter\PresenterInterface;
use Prophecy\Argument;
use Symfony\Component\Translation\TranslatorInterface;

class StepExecutionNormalizerSpec extends ObjectBehavior
{
    function let(TranslatorInterface $translator, PresenterInterface $presenter)
    {
        $this->beConstructedWith($translator, $presenter);
    }

    function it_is_a_normalizer()
    {
        $this->shouldImplement('Symfony\Component\Serializer\Normalizer\NormalizerInterface');
    }

    function it_supports_normalization_of_step_execution(StepExecution $stepExecution)
    {
        $this->supportsNormalization($stepExecution)->shouldBe(true);
    }

    function it_normalizes_a_step_execution(
        $translator,
        $presenter,
        StepExecution $stepExecution,
        BatchStatus $status
    ) {
        $stepExecution->getStepName()->willReturn('export');
        $translator->trans('export')->willReturn('Export step');

        $stepExecution->getSummary()->willReturn(['read' => 12, 'write' => 50]);
        $translator->trans('job_execution.summary.read')->willReturn('Read');
        $translator->trans('job_execution.summary.write')->willReturn('Write');

        $stepExecution->getStatus()->willReturn($status);
        $status->getValue()->willReturn(9);
        $translator->trans('pim_import_export.batch_status.9')->willReturn('PENDING');

        $date = new \DateTime();
        $stepExecution->getStartTime()->willReturn($date);
        $stepExecution->getEndTime()->willReturn(null);

        $stepExecution->getWarnings()->willReturn(
            new ArrayCollection(
                [
                    new Warning(
                        $stepExecution->getWrappedObject(),
                        'a_warning',
                        'warning_reason',
                        ['foo' => 'bar'],
                        ['a' => 'A', 'b' => 'B', 'c' => 'C']
                    )
                ]
            )
        );
        $translator->trans('a_warning')->willReturn('Reader');
        $translator->trans(12)->willReturn(12);
        $translator->trans(50)->willReturn(50);
        $translator->trans('warning_reason', ['foo' => 'bar'])->willReturn('WARNING!');

        $stepExecution->getFailureExceptions()->willReturn(
            [
                [
                    'message'           => 'a_failure',
                    'messageParameters' => ['foo' => 'bar'],
                ]
            ]
        );
        $translator->trans('a_failure', ['foo' => 'bar'])->willReturn('FAIL!');

        $presenter->present($date, Argument::any())->willReturn('22-09-2014');
        $presenter->present(null, Argument::any())->willReturn(null);

        $this->normalize($stepExecution, 'any')->shouldReturn(
            [
               'label'     => 'Export step',
               'status'    => 'PENDING',
               'summary'   => ['Read' => 12, 'Write' => 50],
               'startedAt' => '22-09-2014',
               'endedAt'   => null,
               'warnings'  => [
                   [
                       'label'  => 'Reader',
                       'reason' => 'WARNING!',
                       'item'   => ['a' => 'A', 'b' => 'B', 'c' => 'C'],
                   ]
               ],
               'failures'  => ['FAIL!'],
            ]
        );
    }
}
