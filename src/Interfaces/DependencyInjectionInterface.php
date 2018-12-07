<?php
namespace src\Interfaces;

use \src\Services\DataTransformer;

interface DependencyInjectionInterface
{	
	public function setDataTransformer(DataTransformer $dataTransformer);
}