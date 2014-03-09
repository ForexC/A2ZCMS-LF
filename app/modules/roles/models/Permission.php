<?php namespace App\Modules\Roles\Models;

class Permission extends \Eloquent {
	public function preparePermissionsForDisplay($permissions) {
		// Get all the available permissions
		$availablePermissions = $this -> all() -> toArray();

		foreach ($permissions as &$permission) {
			array_walk($availablePermissions, function(&$value) use (&$permission) {
				if ($permission -> name == $value['name']) {
					$value['checked'] = true;
				}
			});
		}
		return $availablePermissions;
	}

	/**
	 * Convert from input array to savable array.
	 * @param $permissions
	 * @return array
	 */
	public function preparePermissionsForSave($permissions) {
		$availablePermissions = $this -> all() -> toArray();
		$preparedPermissions = array();
		foreach ($permissions as $permission => $value) {
			// If checkbox is selected
			if ($value == '1') {
				// If permission exists
				array_walk($availablePermissions, function(&$value) use ($permission, &$preparedPermissions) {
					if ($permission == (int)$value['id']) {
						$preparedPermissions[] = $permission;
					}
				});
			}
		}
		return $preparedPermissions;
	}

}
