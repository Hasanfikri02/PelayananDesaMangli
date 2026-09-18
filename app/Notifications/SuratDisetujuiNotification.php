<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\PengajuanSurat;

class SuratDisetujuiNotification extends Notification
{
    use Queueable;

    protected $pengajuan;

    /**
     * Create a new notification instance.
     */
    public function __construct(PengajuanSurat $pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail']; // Bisa ditambah 'database' jika mau simpan notifikasi di DB
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Surat Anda Telah Disetujui')
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Surat "' . $this->pengajuan->jenisSurat->nama_surat . '" telah disetujui oleh admin.')
            ->action('Lihat Pengajuan', url('/user/pengajuan')) // arahkan ke halaman riwayat user
            ->line('Segera ambil surat Anda di balai desa. Terima kasih telah menggunakan layanan desa.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'pengajuan_id' => $this->pengajuan->id,
            'jenis_surat' => $this->pengajuan->jenisSurat->nama_surat,
            'status' => $this->pengajuan->status,
        ];
    }
}
