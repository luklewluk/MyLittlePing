# MyLittlePing

Object oriented and full configurable implementation of ICMP echo request message.

## Installation

`composer require luklewluk/mylittleping`

## Basic usage
Using dependency injection:

```
// Create object instances
$config = new Config();
$connection = new Socket($config);
$ping = new Ping($connection, $config);
// Send request
echo $ping->send('google.com') . PHP_EOL;
```

Using static factory:

```
$ping = Ping::createWithConnection(Socket::class);
echo $ping->send('google.com') . PHP_EOL;
```

## Connection implementations
### Socket
The most advanced and customisable connection method.

Requires `root` access.

```
$connection = new Socket($config);
```

### Fsockopen
It is not recommended way to get exact latency time. 
Also it can return response time even if server is not responding.

The method does not support custom parameters.

```
$connection = new Fsockopen($config);
```

### Your own implementation
If you need to use your own connection method (i.e. "exec" way) you 
can easily do it by writing a new class which implements `ConnectionInterface`.

```
$ping = new Ping(new YourClass(), $config);
```

## Custom parameters
List of available parameters to set:
### Port
```
$config->setPort(8080);
```
### Payload
```
$config->setPayload('abcdefg');
```
