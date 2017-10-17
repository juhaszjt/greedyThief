<?php
	function pcPermute($items, $perms = array( ))
	{
		if (empty($items))
		{
			$return = array($perms);
		}  else {
			$return = array();
			for ($i = count($items) - 1; $i >= 0; --$i)
			{
				$newitems = $items;
				$newperms = $perms;
				list($foo) = array_splice($newitems, $i, 1);
				array_unshift($newperms, $foo);
				$return = array_merge($return, pcPermute($newitems, $newperms));
			}
		}
		return $return;
	}

	$value = [
		[
			'weight' => 2,
			'price' => 6
		],
		[
			'weight' => 2,
			'price' => 3
		],
		[
			'weight' => 6,
			'price' => 5
		],
		[
			'weight' => 5,
			'price' => 4
		],
		[
			'weight' => 4,
			'price' => 6
		],
	];
	$permuteResults = pcPermute($value);

	$maxWeightInSack = 10;
	$sack = [];
	$countValue = count($value);
	foreach($permuteResults as $permuteResults)
	{
		$actualWeightInSack = 0;
		$itemsInSack = [];

		foreach($permuteResults as $key => $onePermute)
		{
			if (
				$actualWeightInSack + $onePermute['weight'] <= $maxWeightInSack
			){
				$actualWeightInSack += $onePermute['weight'];
				$itemsInSack[] = $onePermute;

				if (++$key == $countValue)
				{
					$sack[] = $itemsInSack;
				}
			}
			else
			{
				$sack[] = $itemsInSack;
			}
		}
	}

	$maxPrice = 0;
	$maxSack = [];
	foreach($sack as $items)
	{
		$price = 0;
		foreach($items as $item)
		{
			$price += $item['price'];
		}
		if ($price > $maxPrice)
		{
			$maxPrice = $price;
			$maxSack  = $items;
		}
	}
	print $maxPrice . '<br />';
	print_r($maxSack);
?>