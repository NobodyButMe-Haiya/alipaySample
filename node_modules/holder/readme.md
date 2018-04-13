# holder

A simple caching utility for Node.js

## Install

```bash
$ npm install holder
```

## Usage

```javascript
var holder = require('holder');

var cache = new holder.MemoryCache();

cache.store('foo', 'bar');
cache.lookup('foo');  // "bar"
cache.remove('foo');
```

### Cache Types

There are 3 built-in cache types: `NullCache`, `MemoryCache`, and `FileCache`. The first one, `NullCache`, is a fake cache that doesn't actually cache anything, useful for testing purposes. `MemoryCache` simply stores your data in Node.js memory. `FileCache` store your stuff in files on the disk, useful when you don't want use up your memory or if you don't want to lose your cache if your application dies.

### Extending

There is also a base class `Cache` that has the interface for a cache class. By inheriting from this class you can create your cache types.

```javascript
holder.RedisCache = function() {
	holder.Cache.call(this);
};

holder.RedisCache.prototype = new holder.Cache();

holder.RedisCache.prototype.lookup = function(key, callback) {
	// ...
};

holder.RedisCache.prototype.store = function(key, value, callback) {
	// ...
};

holder.RedisCache.prototype.remove = function(key, callback) {
	// ...
}
```
