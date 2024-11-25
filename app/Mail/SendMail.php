<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable {
    use Queueable, SerializesModels;
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Mã xác thực đến từ Bike Shop', 
        );
    }
    
    public function content(): Content {
        return new Content(
            view: 'auth.email.verify',  
            with: [
                'name' => $this->name, 
            ],
        );
    }

    public function attachments(): array {
        return [];  // Nếu có file đính kèm, bạn có thể thêm vào đây
    }
}
