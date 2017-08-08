<?php

namespace Yajra\Acl\Models;

use Illuminate\Support\Collection;
use Yajra\Acl\Traits\HasRole;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string resource
 * @property string name
 * @property string slug
 * @property bool system
 */
class Permission extends Model
{
    use PermissionHasRole;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'resource'];

    // public function usercategoriable()
    // {
    //     return $this->morphMany(config('acl.user', App\User::class), 'usercategoriable');
    // }

    // public function rolecategoriable()
    // {
    //     return $this->morphMany(config('acl.role', Role::class), 'rolecategoriable');
    // }

    /**
     * Create a permissions for a resource.
     *
     * @param $resource
     * @param bool $system
     * @return \Illuminate\Support\Collection
     */
    // public static function createResource($resource, $admin = false)
    public static function createResource($resource)
    {
        $group        = ucfirst($resource);
        $slug         = strtolower($group);
        $permissions  = [
        [
        'slug'     => $slug . '.read',
        'resource' => $slug,
        'name'     => 'Read ' . $group,
        'admin'   => $admin,
        ],
        [
        'slug'     => $slug . '.create',
        'resource' => $slug,
        'name'     => 'Create ' . $group,
        'admin'   => $admin,
        ],
        [
        'slug'     => $slug . '.update',
        'resource' => $slug,
        'name'     => 'Update ' . $group,
        'admin'   => $admin,
        ],
        [
        'slug'     => $slug . '.delete',
        'resource' => $slug,
        'name'     => 'Delete ' . $group,
        'admin'   => $admin,
        ],
        [
        'slug'     => $slug . '.report',
        'resource' => $slug,
        'name'     => 'Report ' . $group,
        'admin'   => $admin,
        ],
        ];

        $collection = new Collection;
        foreach ($permissions as $permission) {
            try {
                $collection->push(static::create($permission));
            } catch (\Exception $e) {
                // permission already exists.
            }
        }

        return $collection;
    }
}
