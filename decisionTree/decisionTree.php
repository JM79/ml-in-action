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

function splitDataSet($dataSet, $axis, $value) {
  $retDataSet = array();
  foreach ($dataSet as $featVec) {
    if ($featVec[$axis] == $value) {
      // Create a new array without this column
      $reducedFeatVec = array_merge(array_splice($featVec, 0, $axis)
                                   ,array_splice($featVec, $axis+1));
      $retDataSet[] = $reducedFeatVec;
    }
  }
  return $retDataSet;
}

$dataSet = array(array(1, 1, 'yes'),
			           array(1, 1, 'yes'),
			           array(1, 0, 'no'),
			           array(0, 1, 'no'),
			           array(0, 1, 'no'));
$labels = array("no surfacing", "flipper");

var_dump("Shannon Entropy:" . calcShannonEnt($dataSet, $labels));
var_dump(splitDataSet($dataSet, 0, 1));
var_dump(splitDataSet($dataSet, 0, 0));

?>