<?php
namespace src\Interfaces;

interface DataTransformerInterface
{
	public function getResult();
	public function setData($data);
	public function transform();
}