<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EnviarEmail extends Command
{
    protected $signature = 'email:send';
    protected $description = 'Envia um e-mail';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $contrato = [
            'numero' => '12345',
            'data' => '03-07-2024',
            'processo' => '123456',
            'fim' => '03-07-2025',
            'secretaria' => 'Secretaria X',
        ];

        Mail::to('medeirosjorge__@hotmail.com')->send(new Sendmail($data));

        $this->info('E-mail enviado com sucesso.');
    }
}
