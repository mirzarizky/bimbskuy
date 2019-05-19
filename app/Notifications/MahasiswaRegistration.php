<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class MahasiswaRegistration extends Notification
{
    use Queueable;

    protected $mahasiswa;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($mahasiswa)
    {
        $this->mahasiswa = $mahasiswa;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Selamat Datang di '.config('app.name').'!')
                    ->greeting('Selamat datang '.$this->mahasiswa->nama.'!')
                    ->line('Terimakasih telah melakukan pendaftaran '.$this->mahasiswa->jenisBimbingan().' di '.config('app.name').'. Akun anda akan aktif
                    setelah diperiksa dan disetujui oleh Dosen Pembimbing. Kami akan menginformasikan anda kembali saat akun anda telah aktif')
                    ->salutation(new HtmlString("Terimakasih,<br>".config('app.name')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
