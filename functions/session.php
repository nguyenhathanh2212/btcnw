<?php

	class SessionManager
	{
		public function start()
		{
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
		}

		public function destroy()
		{
			session_destroy();
		}

		public function has($key)
		{
			return isset($_SESSION[$key]);
		}

		public function set($key, $value)
		{
			$_SESSION[$key] = $value;
		}

		public function get($key)
		{
			return $this->has($key) ? $_SESSION[$key] : ''; 
		}

		public function remove($key)
		{
			if ($this->has($key)) {
				unset($_SESSION[$key]);
			}
		}
	}

	$session = new SessionManager();
	$session->start();
