<?php

namespace Yajra\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Acl\Traits\HasPermission;

/**
 * @property \Yajra\Acl\Models\Permission permissions
 * @property bool system
 */
class Role extends Model
{
    use RoleHasPermission;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'system'];
}
