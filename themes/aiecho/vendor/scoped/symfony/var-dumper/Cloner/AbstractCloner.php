<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mwf\ChildTheme\Deps\Symfony\Component\VarDumper\Cloner;

use Mwf\ChildTheme\Deps\Symfony\Component\VarDumper\Caster\Caster;
use Mwf\ChildTheme\Deps\Symfony\Component\VarDumper\Exception\ThrowingCasterException;
/**
 * AbstractCloner implements a generic caster mechanism for objects and resources.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 * @internal
 */
abstract class AbstractCloner implements ClonerInterface
{
    public static $defaultCasters = ['__PHP_Incomplete_Class' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\Caster', 'castPhpIncompleteClass'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\CutStub' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castStub'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\CutArrayStub' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castCutArray'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ConstStub' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castStub'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\EnumStub' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castEnum'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ScalarStub' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castScalar'], 'Fiber' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\FiberCaster', 'castFiber'], 'Closure' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClosure'], 'Generator' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castGenerator'], 'ReflectionType' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castType'], 'ReflectionAttribute' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castAttribute'], 'ReflectionGenerator' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castReflectionGenerator'], 'ReflectionClass' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClass'], 'ReflectionClassConstant' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClassConstant'], 'ReflectionFunctionAbstract' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castFunctionAbstract'], 'ReflectionMethod' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castMethod'], 'ReflectionParameter' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castParameter'], 'ReflectionProperty' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castProperty'], 'ReflectionReference' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castReference'], 'ReflectionExtension' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castExtension'], 'ReflectionZendExtension' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castZendExtension'], 'Mwf\\ChildTheme\\Deps\\Doctrine\\Common\\Persistence\\ObjectManager' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\ChildTheme\\Deps\\Doctrine\\Common\\Proxy\\Proxy' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castCommonProxy'], 'Mwf\\ChildTheme\\Deps\\Doctrine\\ORM\\Proxy\\Proxy' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castOrmProxy'], 'Mwf\\ChildTheme\\Deps\\Doctrine\\ORM\\PersistentCollection' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castPersistentCollection'], 'Mwf\\ChildTheme\\Deps\\Doctrine\\Persistence\\ObjectManager' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'DOMException' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castException'], 'DOMStringList' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNameList' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMImplementation' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castImplementation'], 'DOMImplementationList' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNode' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNode'], 'DOMNameSpaceNode' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNameSpaceNode'], 'DOMDocument' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDocument'], 'DOMNodeList' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNamedNodeMap' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMCharacterData' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castCharacterData'], 'DOMAttr' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castAttr'], 'DOMElement' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castElement'], 'DOMText' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castText'], 'DOMDocumentType' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDocumentType'], 'DOMNotation' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNotation'], 'DOMEntity' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castEntity'], 'DOMProcessingInstruction' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castProcessingInstruction'], 'DOMXPath' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castXPath'], 'XMLReader' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\XmlReaderCaster', 'castXmlReader'], 'ErrorException' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castErrorException'], 'Exception' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castException'], 'Error' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castError'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Bridge\\Monolog\\Logger' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\EventDispatcher\\EventDispatcherInterface' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\HttpClient\\AmpHttpClient' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\HttpClient\\CurlHttpClient' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\HttpClient\\NativeHttpClient' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\HttpClient\\Response\\AmpResponse' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\HttpClient\\Response\\CurlResponse' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\HttpClient\\Response\\NativeResponse' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\HttpFoundation\\Request' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castRequest'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\Uid\\Ulid' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castUlid'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\Uid\\Uuid' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castUuid'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarExporter\\Internal\\LazyObjectState' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castLazyObjectState'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Exception\\ThrowingCasterException' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castThrowingCasterException'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\TraceStub' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castTraceStub'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\FrameStub' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castFrameStub'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Cloner\\AbstractCloner' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\ErrorHandler\\Exception\\FlattenException' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castFlattenException'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\ErrorHandler\\Exception\\SilencedErrorContext' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castSilencedErrorContext'], 'Mwf\\ChildTheme\\Deps\\Imagine\\Image\\ImageInterface' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ImagineCaster', 'castImage'], 'Mwf\\ChildTheme\\Deps\\Ramsey\\Uuid\\UuidInterface' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\UuidCaster', 'castRamseyUuid'], 'Mwf\\ChildTheme\\Deps\\ProxyManager\\Proxy\\ProxyInterface' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ProxyManagerCaster', 'castProxy'], 'PHPUnit_Framework_MockObject_MockObject' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\ChildTheme\\Deps\\PHPUnit\\Framework\\MockObject\\MockObject' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\ChildTheme\\Deps\\PHPUnit\\Framework\\MockObject\\Stub' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\ChildTheme\\Deps\\Prophecy\\Prophecy\\ProphecySubjectInterface' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\ChildTheme\\Deps\\Mockery\\MockInterface' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'PDO' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\PdoCaster', 'castPdo'], 'PDOStatement' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\PdoCaster', 'castPdoStatement'], 'AMQPConnection' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castConnection'], 'AMQPChannel' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castChannel'], 'AMQPQueue' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castQueue'], 'AMQPExchange' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castExchange'], 'AMQPEnvelope' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castEnvelope'], 'ArrayObject' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castArrayObject'], 'ArrayIterator' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castArrayIterator'], 'SplDoublyLinkedList' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castDoublyLinkedList'], 'SplFileInfo' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castFileInfo'], 'SplFileObject' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castFileObject'], 'SplHeap' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castHeap'], 'SplObjectStorage' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castObjectStorage'], 'SplPriorityQueue' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castHeap'], 'OuterIterator' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castOuterIterator'], 'WeakMap' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castWeakMap'], 'WeakReference' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castWeakReference'], 'Redis' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedis'], 'Mwf\\ChildTheme\\Deps\\Relay\\Relay' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedis'], 'RedisArray' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedisArray'], 'RedisCluster' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedisCluster'], 'DateTimeInterface' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castDateTime'], 'DateInterval' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castInterval'], 'DateTimeZone' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castTimeZone'], 'DatePeriod' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castPeriod'], 'GMP' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\GmpCaster', 'castGmp'], 'MessageFormatter' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castMessageFormatter'], 'NumberFormatter' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castNumberFormatter'], 'IntlTimeZone' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlTimeZone'], 'IntlCalendar' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlCalendar'], 'IntlDateFormatter' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlDateFormatter'], 'Memcached' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\MemcachedCaster', 'castMemcached'], 'Mwf\\ChildTheme\\Deps\\Ds\\Collection' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castCollection'], 'Mwf\\ChildTheme\\Deps\\Ds\\Map' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castMap'], 'Mwf\\ChildTheme\\Deps\\Ds\\Pair' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castPair'], 'Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DsPairStub' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castPairStub'], 'mysqli_driver' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\MysqliCaster', 'castMysqliDriver'], 'CurlHandle' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castCurl'], ':dba' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castDba'], ':dba persistent' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castDba'], 'GdImage' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castGd'], ':gd' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castGd'], ':pgsql large object' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLargeObject'], ':pgsql link' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLink'], ':pgsql link persistent' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLink'], ':pgsql result' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castResult'], ':process' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castProcess'], ':stream' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStream'], 'OpenSSLCertificate' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castOpensslX509'], ':OpenSSL X.509' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castOpensslX509'], ':persistent stream' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStream'], ':stream-context' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStreamContext'], 'XmlParser' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster', 'castXml'], ':xml' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster', 'castXml'], 'RdKafka' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castRdKafka'], 'Mwf\\ChildTheme\\Deps\\RdKafka\\Conf' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castConf'], 'Mwf\\ChildTheme\\Deps\\RdKafka\\KafkaConsumer' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castKafkaConsumer'], 'Mwf\\ChildTheme\\Deps\\RdKafka\\Metadata\\Broker' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castBrokerMetadata'], 'Mwf\\ChildTheme\\Deps\\RdKafka\\Metadata\\Collection' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castCollectionMetadata'], 'Mwf\\ChildTheme\\Deps\\RdKafka\\Metadata\\Partition' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castPartitionMetadata'], 'Mwf\\ChildTheme\\Deps\\RdKafka\\Metadata\\Topic' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicMetadata'], 'Mwf\\ChildTheme\\Deps\\RdKafka\\Message' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castMessage'], 'Mwf\\ChildTheme\\Deps\\RdKafka\\Topic' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopic'], 'Mwf\\ChildTheme\\Deps\\RdKafka\\TopicPartition' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicPartition'], 'Mwf\\ChildTheme\\Deps\\RdKafka\\TopicConf' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicConf'], 'Mwf\\ChildTheme\\Deps\\FFI\\CData' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\FFICaster', 'castCTypeOrCData'], 'Mwf\\ChildTheme\\Deps\\FFI\\CType' => ['Mwf\\ChildTheme\\Deps\\Symfony\\Component\\VarDumper\\Caster\\FFICaster', 'castCTypeOrCData']];
    protected $maxItems = 2500;
    protected $maxString = -1;
    protected $minDepth = 1;
    /**
     * @var array<string, list<callable>>
     */
    private array $casters = [];
    /**
     * @var callable|null
     */
    private $prevErrorHandler;
    private array $classInfo = [];
    private int $filter = 0;
    /**
     * @param callable[]|null $casters A map of casters
     *
     * @see addCasters
     */
    public function __construct(?array $casters = null)
    {
        $this->addCasters($casters ?? static::$defaultCasters);
    }
    /**
     * Adds casters for resources and objects.
     *
     * Maps resources or objects types to a callback.
     * Types are in the key, with a callable caster for value.
     * Resource types are to be prefixed with a `:`,
     * see e.g. static::$defaultCasters.
     *
     * @param callable[] $casters A map of casters
     *
     * @return void
     */
    public function addCasters(array $casters)
    {
        foreach ($casters as $type => $callback) {
            $this->casters[$type][] = $callback;
        }
    }
    /**
     * Sets the maximum number of items to clone past the minimum depth in nested structures.
     *
     * @return void
     */
    public function setMaxItems(int $maxItems)
    {
        $this->maxItems = $maxItems;
    }
    /**
     * Sets the maximum cloned length for strings.
     *
     * @return void
     */
    public function setMaxString(int $maxString)
    {
        $this->maxString = $maxString;
    }
    /**
     * Sets the minimum tree depth where we are guaranteed to clone all the items.  After this
     * depth is reached, only setMaxItems items will be cloned.
     *
     * @return void
     */
    public function setMinDepth(int $minDepth)
    {
        $this->minDepth = $minDepth;
    }
    /**
     * Clones a PHP variable.
     *
     * @param int $filter A bit field of Caster::EXCLUDE_* constants
     */
    public function cloneVar(mixed $var, int $filter = 0) : Data
    {
        $this->prevErrorHandler = \set_error_handler(function ($type, $msg, $file, $line, $context = []) {
            if (\E_RECOVERABLE_ERROR === $type || \E_USER_ERROR === $type) {
                // Cloner never dies
                throw new \ErrorException($msg, 0, $type, $file, $line);
            }
            if ($this->prevErrorHandler) {
                return ($this->prevErrorHandler)($type, $msg, $file, $line, $context);
            }
            return \false;
        });
        $this->filter = $filter;
        if ($gc = \gc_enabled()) {
            \gc_disable();
        }
        try {
            return new Data($this->doClone($var));
        } finally {
            if ($gc) {
                \gc_enable();
            }
            \restore_error_handler();
            $this->prevErrorHandler = null;
        }
    }
    /**
     * Effectively clones the PHP variable.
     */
    protected abstract function doClone(mixed $var) : array;
    /**
     * Casts an object to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     */
    protected function castObject(Stub $stub, bool $isNested) : array
    {
        $obj = $stub->value;
        $class = $stub->class;
        if (\str_contains($class, "@anonymous\x00")) {
            $stub->class = \get_debug_type($obj);
        }
        if (isset($this->classInfo[$class])) {
            [$i, $parents, $hasDebugInfo, $fileInfo] = $this->classInfo[$class];
        } else {
            $i = 2;
            $parents = [$class];
            $hasDebugInfo = \method_exists($class, '__debugInfo');
            foreach (\class_parents($class) as $p) {
                $parents[] = $p;
                ++$i;
            }
            foreach (\class_implements($class) as $p) {
                $parents[] = $p;
                ++$i;
            }
            $parents[] = '*';
            $r = new \ReflectionClass($class);
            $fileInfo = $r->isInternal() || $r->isSubclassOf(Stub::class) ? [] : ['file' => $r->getFileName(), 'line' => $r->getStartLine()];
            $this->classInfo[$class] = [$i, $parents, $hasDebugInfo, $fileInfo];
        }
        $stub->attr += $fileInfo;
        $a = Caster::castObject($obj, $class, $hasDebugInfo, $stub->class);
        try {
            while ($i--) {
                if (!empty($this->casters[$p = $parents[$i]])) {
                    foreach ($this->casters[$p] as $callback) {
                        $a = $callback($obj, $a, $stub, $isNested, $this->filter);
                    }
                }
            }
        } catch (\Exception $e) {
            $a = [(Stub::TYPE_OBJECT === $stub->type ? Caster::PREFIX_VIRTUAL : '') . '⚠' => new ThrowingCasterException($e)] + $a;
        }
        return $a;
    }
    /**
     * Casts a resource to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     */
    protected function castResource(Stub $stub, bool $isNested) : array
    {
        $a = [];
        $res = $stub->value;
        $type = $stub->class;
        try {
            if (!empty($this->casters[':' . $type])) {
                foreach ($this->casters[':' . $type] as $callback) {
                    $a = $callback($res, $a, $stub, $isNested, $this->filter);
                }
            }
        } catch (\Exception $e) {
            $a = [(Stub::TYPE_OBJECT === $stub->type ? Caster::PREFIX_VIRTUAL : '') . '⚠' => new ThrowingCasterException($e)] + $a;
        }
        return $a;
    }
}
