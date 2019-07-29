<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;

class MahasiswaApproved extends Notification
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
            ->subject('Buat Password Baru Anda')
            ->greeting('Halo '.$this->mahasiswa->nama.'!')
            ->line('Terimakasih telah melakukan pendaftaran '.$this->mahasiswa->jenisBimbingan().' di '.config('app.name').'. Silahkan 
            klik tombol di bawah ini untuk membuat password baru:')
            ->action('Buat Password Baru', $this->makeNewPasswordUrl($notifiable))
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

    public function makeNewPasswordUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'password.new', Carbon::now()->addDays(3), ['id' => $notifiable->getKey()]
        );
    }
}
