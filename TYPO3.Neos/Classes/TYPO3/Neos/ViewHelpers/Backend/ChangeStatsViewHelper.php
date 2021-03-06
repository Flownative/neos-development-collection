<?php
namespace TYPO3\Neos\ViewHelpers\Backend;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.Neos".            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Displays a text-based "bar graph" giving an indication of the amount and type of
 * changes done to something. Created for use in workspace management.
 */
class ChangeStatsViewHelper extends AbstractViewHelper
{

    /**
     * @var boolean
     */
    protected $escapeOutput = false;

    /**
     * Expects an array of change count data and returns HTML with a "bar graph".
     *
     * @param array $changeCounts Expected keys: new, changed, removed
     * @return string
     */
    public function render(array $changeCounts)
    {
        if ($changeCounts['total'] === 0) {
            return str_repeat('<span class="neos-change neos-change-unchanged">■</span>', 10);
        }

        $changeCountRatios = [
            'new' => round($changeCounts['new'] / $changeCounts['total'] * 10),
            'changed' => round($changeCounts['changed'] / $changeCounts['total'] * 10),
            'removed' => round($changeCounts['removed'] / $changeCounts['total'] * 10)
        ];

        return
            str_repeat('<span class="neos-change neos-change-new">■</span>', $changeCountRatios['new']) .
            str_repeat('<span class="neos-change neos-change-changed">■</span>', $changeCountRatios['changed']) .
            str_repeat('<span class="neos-change neos-change-removed">■</span>', $changeCountRatios['removed']);
    }
}
