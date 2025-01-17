<x-mail::message>
    # Mensagem de {{ $data['numero'] }}

    <p>Data do Contrato: {{ $contrato['data'] }}</p>
    <p>Numero do  Processo: {{ $contrato['processo'] }}</p>
    <p>Termino do Contrato: {{ $contrato['fim'] }}</p>
    <p>Secretaria Destinada: {{ $contrato['secretaria'] }}</p>

    <x-mail::button :url="'https://contratos.mesquita.rj.gov.br'">
        Clique aqui para ir para o site!
    </x-mail::button>

    Obrigado,<br>
    {{ config('app.name') }}
</x-mail::message>
