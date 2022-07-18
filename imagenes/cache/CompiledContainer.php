<?php
/**
 * This class has been auto-generated by PHP-DI.
 */
class CompiledContainer extends DI\CompiledContainer{
    const METHOD_MAPPING = array (
  'cache' => 'get1',
  'view' => 'get2',
  'flash' => 'get3',
  'audit' => 'get4',
  'log' => 'get5',
  'sqllogger' => 'get6',
  'csrf' => 'get7',
  'debugstack' => 'get8',
  'debugsqllogger' => 'get9',
  'security' => 'get10',
  'profile' => 'get11',
  'language' => 'get12',
  'timer' => 'get13',
  'session' => 'get14',
  'audittrail' => 'get15',
  'encuesta' => 'get16',
  'equipo' => 'get17',
  'equipotorneo' => 'get18',
  'participante' => 'get19',
  'partidos' => 'get20',
  'torneo' => 'get21',
  'usuario' => 'get22',
  'estadio' => 'get23',
  'usertable' => 'get24',
);

    protected function get1()
    {
        return $this->resolveFactory(static function (\Psr\Container\ContainerInterface $c) {
        return new \Slim\HttpCache\CacheProvider();
    }, 'cache');
    }

    protected function get2()
    {
        return $this->resolveFactory(static function (\Psr\Container\ContainerInterface $c) {
        return new \Slim\Views\PhpRenderer("views/");
    }, 'view');
    }

    protected function get3()
    {
        return $this->resolveFactory(static function (\Psr\Container\ContainerInterface $c) {
        return new \Slim\Flash\Messages();
    }, 'flash');
    }

    protected function get4()
    {
        return $this->resolveFactory(static function (\Psr\Container\ContainerInterface $c) {
        $logger = new \Monolog\Logger("audit"); // For audit trail
        $logger->pushHandler(new \PHPMaker2022\project1\AuditTrailHandler("registro/audit.log"));
        return $logger;
    }, 'audit');
    }

    protected function get5()
    {
        return $this->resolveFactory(static function (\Psr\Container\ContainerInterface $c) {
        global $RELATIVE_PATH;
        $logger = new \Monolog\Logger("log");
        $logger->pushHandler(new \Monolog\Handler\RotatingFileHandler($RELATIVE_PATH . "registro/log.log"));
        return $logger;
    }, 'log');
    }

    protected function get6()
    {
        return $this->resolveFactory(static function (\Psr\Container\ContainerInterface $c) {
        $loggers = [];
        if (\PHPMaker2022\project1\Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        $loggers[] = $c->get("debugsqllogger");
        return (count($loggers) > 0) ? new \Doctrine\DBAL\Logging\LoggerChain($loggers) : null;
    }, 'sqllogger');
    }

    protected function get7()
    {
        return $this->resolveFactory(static function (\Psr\Container\ContainerInterface $c) {
        global $ResponseFactory;
        return new \Slim\Csrf\Guard($ResponseFactory, \PHPMaker2022\project1\Config("CSRF_PREFIX"));
    }, 'csrf');
    }

    protected function get8()
    {
        $object = new Doctrine\DBAL\Logging\DebugStack();
        return $object;
    }

    protected function get9()
    {
        $object = new PHPMaker2022\project1\DebugSqlLogger();
        return $object;
    }

    protected function get10()
    {
        $object = new PHPMaker2022\project1\AdvancedSecurity();
        return $object;
    }

    protected function get11()
    {
        $object = new PHPMaker2022\project1\UserProfile();
        return $object;
    }

    protected function get12()
    {
        $object = new PHPMaker2022\project1\Language();
        return $object;
    }

    protected function get13()
    {
        $object = new PHPMaker2022\project1\Timer(true);
        return $object;
    }

    protected function get14()
    {
        $object = new PHPMaker2022\project1\HttpSession();
        return $object;
    }

    protected function get15()
    {
        $object = new PHPMaker2022\project1\Audittrail();
        return $object;
    }

    protected function get16()
    {
        $object = new PHPMaker2022\project1\Encuesta();
        return $object;
    }

    protected function get17()
    {
        $object = new PHPMaker2022\project1\Equipo();
        return $object;
    }

    protected function get18()
    {
        $object = new PHPMaker2022\project1\Equipotorneo();
        return $object;
    }

    protected function get19()
    {
        $object = new PHPMaker2022\project1\Participante();
        return $object;
    }

    protected function get20()
    {
        $object = new PHPMaker2022\project1\Partidos();
        return $object;
    }

    protected function get21()
    {
        $object = new PHPMaker2022\project1\Torneo();
        return $object;
    }

    protected function get22()
    {
        $object = new PHPMaker2022\project1\Usuario();
        return $object;
    }

    protected function get23()
    {
        $object = new PHPMaker2022\project1\Estadio();
        return $object;
    }

    protected function get24()
    {
        return $this->delegateContainer->get('usuario');
    }

}