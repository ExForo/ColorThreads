<?php

abstract class Exile_ColorThreads_Option_ColorThreads
{
	public static function renderOption(XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit)
	{
		$value = $preparedOption['option_value'];

		$choices = array();
		foreach ($value AS $word)
		{
			$choices[] = array(
				'thread' => $word['thread'],
				'color' => is_string($word['color']) ? $word['color'] : ''
			);
		}

		$editLink = $view->createTemplateObject('option_list_option_editlink', array(
			'preparedOption' => $preparedOption,
			'canEditOptionDefinition' => $canEdit
		));

		return $view->createTemplateObject('option_template_colorThreads', array(
			'fieldPrefix' => $fieldPrefix,
			'listedFieldName' => $fieldPrefix . '_listed[]',
			'preparedOption' => $preparedOption,
			'formatParams' => $preparedOption['formatParams'],
			'editLink' => $editLink,

			'choices' => $choices,
			'nextCounter' => count($choices)
		));
	}

	public static function verifyOption(array &$datas, XenForo_DataWriter $dw, $fieldName)
	{
		$output = array();

		foreach ($datas AS $word)
		{
			if (!isset($word['thread']) || !isset($word['color']))
			{
				continue;
			}

			$cache = self::buildCensorCacheValue($word['thread'], $word['color']);
			if ($cache)
			{
				$output[] = $cache;
			}
		}

		$datas = $output;

		return true;
	}

	public static function buildCensorCacheValue($find, $replace)
	{
		$find = trim(strval($find));
		if ($find === '')
		{
			return false;
		}

		$replace = is_int($replace) ? '' : trim(strval($replace));

		$regexFind = $find;
		if (!strlen($regexFind))
		{
			return false;
		}

		return array(
			'thread' => $find,
			'color' => $replace
		);
	}
}