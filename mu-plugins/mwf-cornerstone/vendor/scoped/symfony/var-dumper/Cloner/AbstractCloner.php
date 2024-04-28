<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mwf\Cornerstone\Deps\Symfony\Component\VarDumper\Cloner;

use Mwf\Cornerstone\Deps\Symfony\Component\VarDumper\Caster\Caster;
use Mwf\Cornerstone\Deps\Symfony\Component\VarDumper\Exception\ThrowingCasterException;
/**
 * AbstractCloner implements a generic caster mechanism for objects and resources.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 * @internal
 */
abstract class AbstractCloner implements ClonerInterface
{
    public static $defaultCasters = ['__PHP_Incomplete_Class' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\Caster', 'castPhpIncompleteClass'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\CutStub' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castStub'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\CutArrayStub' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castCutArray'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ConstStub' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castStub'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\EnumStub' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castEnum'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ScalarStub' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castScalar'], 'Fiber' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\FiberCaster', 'castFiber'], 'Closure' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClosure'], 'Generator' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castGenerator'], 'ReflectionType' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castType'], 'ReflectionAttribute' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castAttribute'], 'ReflectionGenerator' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castReflectionGenerator'], 'ReflectionClass' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClass'], 'ReflectionClassConstant' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClassConstant'], 'ReflectionFunctionAbstract' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castFunctionAbstract'], 'ReflectionMethod' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castMethod'], 'ReflectionParameter' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castParameter'], 'ReflectionProperty' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castProperty'], 'ReflectionReference' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castReference'], 'ReflectionExtension' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castExtension'], 'ReflectionZendExtension' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castZendExtension'], 'Mwf\\Cornerstone\\Deps\\Doctrine\\Common\\Persistence\\ObjectManager' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\Cornerstone\\Deps\\Doctrine\\Common\\Proxy\\Proxy' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castCommonProxy'], 'Mwf\\Cornerstone\\Deps\\Doctrine\\ORM\\Proxy\\Proxy' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castOrmProxy'], 'Mwf\\Cornerstone\\Deps\\Doctrine\\ORM\\PersistentCollection' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castPersistentCollection'], 'Mwf\\Cornerstone\\Deps\\Doctrine\\Persistence\\ObjectManager' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'DOMException' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castException'], 'DOMStringList' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNameList' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMImplementation' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castImplementation'], 'DOMImplementationList' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNode' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNode'], 'DOMNameSpaceNode' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNameSpaceNode'], 'DOMDocument' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDocument'], 'DOMNodeList' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNamedNodeMap' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMCharacterData' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castCharacterData'], 'DOMAttr' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castAttr'], 'DOMElement' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castElement'], 'DOMText' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castText'], 'DOMDocumentType' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDocumentType'], 'DOMNotation' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNotation'], 'DOMEntity' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castEntity'], 'DOMProcessingInstruction' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castProcessingInstruction'], 'DOMXPath' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castXPath'], 'XMLReader' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\XmlReaderCaster', 'castXmlReader'], 'ErrorException' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castErrorException'], 'Exception' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castException'], 'Error' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castError'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Bridge\\Monolog\\Logger' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\EventDispatcher\\EventDispatcherInterface' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\HttpClient\\AmpHttpClient' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\HttpClient\\CurlHttpClient' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\HttpClient\\NativeHttpClient' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\HttpClient\\Response\\AmpResponse' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\HttpClient\\Response\\CurlResponse' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\HttpClient\\Response\\NativeResponse' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\HttpFoundation\\Request' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castRequest'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\Uid\\Ulid' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castUlid'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\Uid\\Uuid' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castUuid'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarExporter\\Internal\\LazyObjectState' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castLazyObjectState'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Exception\\ThrowingCasterException' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castThrowingCasterException'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\TraceStub' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castTraceStub'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\FrameStub' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castFrameStub'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Cloner\\AbstractCloner' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\ErrorHandler\\Exception\\FlattenException' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castFlattenException'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\ErrorHandler\\Exception\\SilencedErrorContext' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castSilencedErrorContext'], 'Mwf\\Cornerstone\\Deps\\Imagine\\Image\\ImageInterface' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ImagineCaster', 'castImage'], 'Mwf\\Cornerstone\\Deps\\Ramsey\\Uuid\\UuidInterface' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\UuidCaster', 'castRamseyUuid'], 'Mwf\\Cornerstone\\Deps\\ProxyManager\\Proxy\\ProxyInterface' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ProxyManagerCaster', 'castProxy'], 'PHPUnit_Framework_MockObject_MockObject' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\Cornerstone\\Deps\\PHPUnit\\Framework\\MockObject\\MockObject' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\Cornerstone\\Deps\\PHPUnit\\Framework\\MockObject\\Stub' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\Cornerstone\\Deps\\Prophecy\\Prophecy\\ProphecySubjectInterface' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'Mwf\\Cornerstone\\Deps\\Mockery\\MockInterface' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'PDO' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\PdoCaster', 'castPdo'], 'PDOStatement' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\PdoCaster', 'castPdoStatement'], 'AMQPConnection' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castConnection'], 'AMQPChannel' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castChannel'], 'AMQPQueue' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castQueue'], 'AMQPExchange' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castExchange'], 'AMQPEnvelope' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castEnvelope'], 'ArrayObject' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castArrayObject'], 'ArrayIterator' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castArrayIterator'], 'SplDoublyLinkedList' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castDoublyLinkedList'], 'SplFileInfo' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castFileInfo'], 'SplFileObject' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castFileObject'], 'SplHeap' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castHeap'], 'SplObjectStorage' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castObjectStorage'], 'SplPriorityQueue' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castHeap'], 'OuterIterator' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castOuterIterator'], 'WeakMap' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castWeakMap'], 'WeakReference' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castWeakReference'], 'Redis' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedis'], 'Mwf\\Cornerstone\\Deps\\Relay\\Relay' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedis'], 'RedisArray' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedisArray'], 'RedisCluster' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedisCluster'], 'DateTimeInterface' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castDateTime'], 'DateInterval' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castInterval'], 'DateTimeZone' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castTimeZone'], 'DatePeriod' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castPeriod'], 'GMP' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\GmpCaster', 'castGmp'], 'MessageFormatter' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castMessageFormatter'], 'NumberFormatter' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castNumberFormatter'], 'IntlTimeZone' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlTimeZone'], 'IntlCalendar' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlCalendar'], 'IntlDateFormatter' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlDateFormatter'], 'Memcached' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\MemcachedCaster', 'castMemcached'], 'Mwf\\Cornerstone\\Deps\\Ds\\Collection' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castCollection'], 'Mwf\\Cornerstone\\Deps\\Ds\\Map' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castMap'], 'Mwf\\Cornerstone\\Deps\\Ds\\Pair' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castPair'], 'Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DsPairStub' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castPairStub'], 'mysqli_driver' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\MysqliCaster', 'castMysqliDriver'], 'CurlHandle' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castCurl'], ':dba' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castDba'], ':dba persistent' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castDba'], 'GdImage' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castGd'], ':gd' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castGd'], ':pgsql large object' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLargeObject'], ':pgsql link' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLink'], ':pgsql link persistent' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLink'], ':pgsql result' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castResult'], ':process' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castProcess'], ':stream' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStream'], 'OpenSSLCertificate' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castOpensslX509'], ':OpenSSL X.509' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castOpensslX509'], ':persistent stream' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStream'], ':stream-context' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStreamContext'], 'XmlParser' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster', 'castXml'], ':xml' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster', 'castXml'], 'RdKafka' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castRdKafka'], 'Mwf\\Cornerstone\\Deps\\RdKafka\\Conf' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castConf'], 'Mwf\\Cornerstone\\Deps\\RdKafka\\KafkaConsumer' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castKafkaConsumer'], 'Mwf\\Cornerstone\\Deps\\RdKafka\\Metadata\\Broker' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castBrokerMetadata'], 'Mwf\\Cornerstone\\Deps\\RdKafka\\Metadata\\Collection' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castCollectionMetadata'], 'Mwf\\Cornerstone\\Deps\\RdKafka\\Metadata\\Partition' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castPartitionMetadata'], 'Mwf\\Cornerstone\\Deps\\RdKafka\\Metadata\\Topic' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicMetadata'], 'Mwf\\Cornerstone\\Deps\\RdKafka\\Message' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castMessage'], 'Mwf\\Cornerstone\\Deps\\RdKafka\\Topic' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopic'], 'Mwf\\Cornerstone\\Deps\\RdKafka\\TopicPartition' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicPartition'], 'Mwf\\Cornerstone\\Deps\\RdKafka\\TopicConf' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicConf'], 'Mwf\\Cornerstone\\Deps\\FFI\\CData' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\FFICaster', 'castCTypeOrCData'], 'Mwf\\Cornerstone\\Deps\\FFI\\CType' => ['Mwf\\Cornerstone\\Deps\\Symfony\\Component\\VarDumper\\Caster\\FFICaster', 'castCTypeOrCData']];
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
