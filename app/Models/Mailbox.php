<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'mailboxes';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'reservation_id',
  ];

  public function reservation()
  {
    return $this->belongsTo(Reservation::class);
  }

  public function users()
  {
    return $this->belongsToMany(User::class, 'mailbox_users', 'mailbox_id', 'user_id');
  }

  public function messages()
  {
    return $this->hasMany(Message::class);
  }
}
