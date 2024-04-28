<?php

namespace Mwf\Env;

class Installer {

    protected function __construct(
        protected string $port = '',
        protected string $remote_url = '',
        protected string $ssh_host = '',
        protected string $ssh_user = '',
    )
    {
        $this->putWpEnv();
        $this->putHtaccess();
        $this->putEnv();
    }

    public static function init( \Composer\Script\Event $event ): void
    {
        $io = $event->getIO();

        echo $dir = dirname( __FILE__, 2 );

        $installer = new Installer( 
            $io->ask( 'Local Port: ' ),
            $io->ask( 'Remote URL: ' ),
            $io->ask( 'SSH Host: ' ),
            $io->ask( 'SSH User: ' )
        );
    }

    /**
     * Inject variables into (new) wpenv.json file
     *
     * @return void
     */
    protected function putWpEnv(): void
    {
        $dir = dirname( __DIR__, 1 );

        $json = json_decode( file_get_contents( dirname( __FILE__ ). '/.wp-env.json' ), true );

        $json['port'] = intval( $this->port );
        $json['testsPort'] = intval( $this->port ) + 1;

        file_put_contents( dirname( __FILE__, 2 ) . '/.wp-env.json', json_encode( $json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) );
    }

    protected function putHtaccess(): void
    {
        $dir = dirname( __DIR__, 1 );

        $htaccess = file_get_contents( dirname( __FILE__ ). '/.htaccess' );

        $htaccess = str_replace( '{REMOTE_URL}', rtrim( $this->remote_url, '/' ), $htaccess );

        file_put_contents( dirname( __FILE__, 2 ) . '/.htaccess', $htaccess );
    }

    protected function putEnv(): void
    {
        $env = sprintf("SSH=\"%s\"",
        $this->ssh_user . '@' . $this->ssh_host, 
        );

        file_put_contents( dirname( __FILE__, 2 ) . '/.env', $env );
    }
}