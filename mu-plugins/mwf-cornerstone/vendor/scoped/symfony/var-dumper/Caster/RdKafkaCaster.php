<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mwf\Cornerstone\Deps\Symfony\Component\VarDumper\Caster;

use RdKafka\Conf;
use RdKafka\Exception as RdKafkaException;
use RdKafka\KafkaConsumer;
use RdKafka\Message;
use RdKafka\Metadata\Broker as BrokerMetadata;
use RdKafka\Metadata\Collection as CollectionMetadata;
use RdKafka\Metadata\Partition as PartitionMetadata;
use RdKafka\Metadata\Topic as TopicMetadata;
use RdKafka\Topic;
use RdKafka\TopicConf;
use RdKafka\TopicPartition;
use Mwf\Cornerstone\Deps\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * Casts RdKafka related classes to array representation.
 *
 * @author Romain Neutron <imprec@gmail.com>
 * @internal
 */
class RdKafkaCaster
{
    /**
     * @return array
     */
    public static function castKafkaConsumer(KafkaConsumer $c, array $a, Stub $stub, bool $isNested)
    {
        $prefix = Caster::PREFIX_VIRTUAL;
        try {
            $assignment = $c->getAssignment();
        } catch (RdKafkaException) {
            $assignment = [];
        }
        $a += [$prefix . 'subscription' => $c->getSubscription(), $prefix . 'assignment' => $assignment];
        $a += self::extractMetadata($c);
        return $a;
    }
    /**
     * @return array
     */
    public static function castTopic(Topic $c, array $a, Stub $stub, bool $isNested)
    {
        $prefix = Caster::PREFIX_VIRTUAL;
        $a += [$prefix . 'name' => $c->getName()];
        return $a;
    }
    /**
     * @return array
     */
    public static function castTopicPartition(TopicPartition $c, array $a)
    {
        $prefix = Caster::PREFIX_VIRTUAL;
        $a += [$prefix . 'offset' => $c->getOffset(), $prefix . 'partition' => $c->getPartition(), $prefix . 'topic' => $c->getTopic()];
        return $a;
    }
    /**
     * @return array
     */
    public static function castMessage(Message $c, array $a, Stub $stub, bool $isNested)
    {
        $prefix = Caster::PREFIX_VIRTUAL;
        $a += [$prefix . 'errstr' => $c->errstr()];
        return $a;
    }
    /**
     * @return array
     */
    public static function castConf(Conf $c, array $a, Stub $stub, bool $isNested)
    {
        $prefix = Caster::PREFIX_VIRTUAL;
        foreach ($c->dump() as $key => $value) {
            $a[$prefix . $key] = $value;
        }
        return $a;
    }
    /**
     * @return array
     */
    public static function castTopicConf(TopicConf $c, array $a, Stub $stub, bool $isNested)
    {
        $prefix = Caster::PREFIX_VIRTUAL;
        foreach ($c->dump() as $key => $value) {
            $a[$prefix . $key] = $value;
        }
        return $a;
    }
    /**
     * @return array
     */
    public static function castRdKafka(\RdKafka $c, array $a, Stub $stub, bool $isNested)
    {
        $prefix = Caster::PREFIX_VIRTUAL;
        $a += [$prefix . 'out_q_len' => $c->getOutQLen()];
        $a += self::extractMetadata($c);
        return $a;
    }
    /**
     * @return array
     */
    public static function castCollectionMetadata(CollectionMetadata $c, array $a, Stub $stub, bool $isNested)
    {
        $a += \iterator_to_array($c);
        return $a;
    }
    /**
     * @return array
     */
    public static function castTopicMetadata(TopicMetadata $c, array $a, Stub $stub, bool $isNested)
    {
        $prefix = Caster::PREFIX_VIRTUAL;
        $a += [$prefix . 'name' => $c->getTopic(), $prefix . 'partitions' => $c->getPartitions()];
        return $a;
    }
    /**
     * @return array
     */
    public static function castPartitionMetadata(PartitionMetadata $c, array $a, Stub $stub, bool $isNested)
    {
        $prefix = Caster::PREFIX_VIRTUAL;
        $a += [$prefix . 'id' => $c->getId(), $prefix . 'err' => $c->getErr(), $prefix . 'leader' => $c->getLeader()];
        return $a;
    }
    /**
     * @return array
     */
    public static function castBrokerMetadata(BrokerMetadata $c, array $a, Stub $stub, bool $isNested)
    {
        $prefix = Caster::PREFIX_VIRTUAL;
        $a += [$prefix . 'id' => $c->getId(), $prefix . 'host' => $c->getHost(), $prefix . 'port' => $c->getPort()];
        return $a;
    }
    /**
     * @return array
     */
    private static function extractMetadata(KafkaConsumer|\RdKafka $c)
    {
        $prefix = Caster::PREFIX_VIRTUAL;
        try {
            $m = $c->getMetadata(\true, null, 500);
        } catch (RdKafkaException) {
            return [];
        }
        return [$prefix . 'orig_broker_id' => $m->getOrigBrokerId(), $prefix . 'orig_broker_name' => $m->getOrigBrokerName(), $prefix . 'brokers' => $m->getBrokers(), $prefix . 'topics' => $m->getTopics()];
    }
}
