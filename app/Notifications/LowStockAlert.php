<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LowStockAlert extends Notification
{
    use Queueable;

    public $items;

    /**
     * Create a new notification instance.
     * Kita terima data barang yang stoknya menipis
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Tentukan channel pengiriman: 'mail' (email) dan 'database' (lonceng di navbar)
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Format tampilan Email
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
                    ->subject('⚠️ Peringatan: Stok Barang Menipis!')
                    ->greeting('Halo Admin,')
                    ->line('Sistem mendeteksi ada ' . $this->items->count() . ' barang yang stoknya mencapai batas minimum:');

        // List barang di email
        foreach ($this->items as $item) {
            $mail->line("- {$item->name} ({$item->part_number}): Sisa {$item->stock} {$item->unit}");
        }

        return $mail->action('Cek Inventaris', url('/spareparts'))
                    ->line('Segera lakukan restock untuk menjaga ketersediaan barang.');
    }

    /**
     * Format penyimpanan ke Database (untuk ikon lonceng)
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Stok Menipis!',
            'message' => 'Ada ' . $this->items->count() . ' barang perlu restock.',
            'url' => route('spareparts.index'),
            'icon' => 'fas fa-exclamation-triangle' // FontAwesome icon class
        ];
    }
}