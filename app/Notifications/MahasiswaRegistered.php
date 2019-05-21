<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Str;
use NotificationChannels\OneSignal\OneSignalMessage;

class MahasiswaRegistered extends Notification
{
    use Queueable;

    protected $mahasiswa;
    protected $dosbingKe;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($mahasiswa, $dosbingKe = null)
    {
        $this->mahasiswa = $mahasiswa;
        $this->dosbingKe = $dosbingKe;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'broadcast',
            'database', 
            OneSignalChannel::class
        ];
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
            'mahasiswa_id' => $this->mahasiswa->id
        ];
    }

    public function toBroadcast($notifiable)
    {
        $bimbingan = Str::ucfirst($this->mahasiswa->jenisBimbingan()).'.';
        $periksa = 'Periksa dan setujui agar dapat melakukan bimbingan.';
        $info = $this->dosbingKe == 2
            ? "II ".$bimbingan
            : ($this->dosbingKe == 3
            ? "III ".$bimbingan
            : $bimbingan.' '.$periksa
            )
        ;

//        TODO: url untuk klik di notifikasi
        return new BroadcastMessage([
            'message'       => $this->mahasiswa->nama.' mendaftarkan anda sebagai Dosen Pembimbing '.$info,
            'mahasiswa_id'  => $this->mahasiswa->id,
            'url'           => url('mahasiswa/'.$this->mahasiswa->id),
            'created_at'    => Carbon::parse($notifiable->created_at)->toDateTimeString()
        ]);
    }

    public function toDatabase($notifiable)
    {
        $bimbingan = Str::ucfirst($this->mahasiswa->jenisBimbingan()).'.';
        $periksa = 'Periksa dan setujui agar dapat melakukan bimbingan.';
        $info = $this->dosbingKe == 2
            ? "II ".$bimbingan
            : ($this->dosbingKe == 3
                ? "III ".$bimbingan
                : $bimbingan.' '.$periksa
            )
        ;

//        TODO: url untuk klik di notifikasi
        return [
            'message'       => $this->mahasiswa->nama.' mendaftarkan anda sebagai Dosen Pembimbing '.$info,
            'mahasiswa_id'  => $this->mahasiswa->id,
            'url'           => url('mahasiswa/'.$this->mahasiswa->id),
        ];
    }

    public function toOneSignal($notifiable)
    {
        $data = ['abc' => '123', 'foo' => 'bar'];

        return OneSignalMessage::create()
            ->setSubject($this->mahasiswa->nama.' mendaftarkan anda sebagai Dosen Pembimbing')
            ->setBody("Klik untuk lebih lanjut.")
            ->setParameter('android_group', 'mahasiswa_registration')
            ->setData('data', $data);
    }
}
