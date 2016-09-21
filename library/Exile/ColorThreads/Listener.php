<?php

class Exile_ColorThreads_Listener
{
	public static function load_class($class, array &$extend)
	{
		if ($class == 'XenForo_Model_Thread')
		{
			$extend[] = 'Exile_ColorThreads_Extend_Model_Thread';
		}
	}
}