<?php

function calcShannonEnt($dataSet) {
  $numEntries = count($dataSet);
  $labelCounts = array();
  foreach ($dataSet as $featVec) {
  	$currentLabel = $featVec[count($featVec)-1]; /* Take the last column as the label */
  	if (!isset($labelCounts[$currentLabel])) {
  		$labelCounts[$currentLabel] = 0;
  	}
  	$labelCounts[$currentLabel] += 1;
  }
  $shannonEnt = 0.0;
  foreach ($labelCounts as $labelCount) {
  	$prob = $labelCount/$numEntries;
  	$shannonEnt -= $prob * log($prob, 2);
  }
  return $shannonEnt;
}

$dataSet = array(array(1, 1, 'yes'),
			array(1, 1, 'yes'),
			array(1, 0, 'no'),
			array(0, 1, 'no'),
			array(0, 1, 'no'));

$labels = array('no surfacing','flippers');

var_dump(calcShannonEnt($dataSet, $labels));

?>