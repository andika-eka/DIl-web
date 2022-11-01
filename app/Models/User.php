<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Helper\Tokenable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Siswa;
use App\Models\Pengajar;

class User extends Authenticatable
{
     use HasApiTokens, HasFactory, Notifiable, Tokenable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipe_pengguna',
        'status_pengguna',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function saveUser($request): self
    {
        /*
        tipe pengguna:
        1 = admin
        2 = pengajar
        3 = siswa
        */
        $this->name = $request->name;
        $this->email = $request->email;
        $this->password = bcrypt($request->password);
        $this->tipe_pengguna = $request->tipe_pengguna;
        $this->status_pengguna = $request->status_pengguna;
        $this->save();

        if($this->tipe_pengguna == 2) 
        {
            $pengajar  = new Pengajar;
            $pengajar->id_pengajar = $this->id;
            $pengajar->email_pengajar = $this->email;
            $pengajar->save();
        } 
        else if($this->tipe_pengguna == 3)
        {
            $siswa = new Siswa;
            $siswa->id_siswa = $this->id;
            $siswa->email_siswa = $this->email;
            $siswa->save();
        }

        return $this;
    }

    public function detail()
    {
        if($this->tipe_pengguna == 3)
        {
            return $this->hasOne(Siswa::class, "id_siswa", "id");    
        } 
        else if ($this->tipe_pengguna == 2)
        {
            return $this->hasOne(Pengajar::class, "id_pengajar", "id");
        }
        
    }
    
    public function newPassword($password)
    {
        $this->password = bcrypt($password);
        $this->save();
    }
}
