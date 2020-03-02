<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use test\Mockery\ReturnTypeObjectTypeHint;
use Zizaco\Entrust\Traits\EntrustUserTrait;
class User extends Authenticatable
{
    use EntrustUserTrait;
    public $guarded = ['role_id','user_id'];
    public function Department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
}
