<?php

class Exile_ColorThreads_Extend_Model_Thread extends XFCP_Exile_ColorThreads_Extend_Model_Thread
{
	/**
	 * Prepares a thread for display, generally within the context of a specific forum.
	 *
	 * @param array $thread Thread to prepare
	 * @param array $forum Forum thread is in
	 * @param array|null $nodePermissions
	 * @param array|null $viewingUser
	 *
	 * @return array Prepared version of thread
	 */
	public function prepareThread(array $thread, array $forum, array $nodePermissions = null, array $viewingUser = null)
	{
		$thread = parent::prepareThread($thread, $forum, $nodePermissions, $viewingUser);

		$color_threads = XenForo_Application::get('options')->exile_colorThreads;

		foreach ($color_threads AS $thread_id => &$color)
		{
			if ($thread['thread_id'] == $color['thread'])
			{
				$thread['color'] = $color['color'];
			}
		}

		return $thread;
	}
}