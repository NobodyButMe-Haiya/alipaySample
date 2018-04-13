
var fs    = require('fs');
var path  = require('path');

exports.create = function(type, filePath) {
	switch (type) {
		case 'none':
		case 'null':
		case false:
		case null:
			return new NullCache();
		break;
		case 'file':
			return new FileCache(filePath);
		break;
		case 'memory':
			return new MemoryCache();
		break;
		default:
			throw new Error('Cache type "' + type + '" is not a recognized type');
		break;
	}
}

// -------------------------------------------------------------

var Cache = exports.Cache = function() {

}

Cache.prototype.lookup = function(color) {
	throw new Error('Cache::lookup must be replaced by inheriting class');
};

Cache.prototype.store = function(color, imageBuffer) {
	throw new Error('Cache::store must be replaced by inheriting class');
};

Cache.prototype.store = function(color, imageBuffer) {
	throw new Error('Cache::remove must be replaced by inheriting class');
};

// -------------------------------------------------------------

var NullCache = exports.NullCache = function() {
	Cache.call(this);
}

NullCache.prototype = new Cache();

NullCache.prototype.lookup = function(key) {
	return false;
};

NullCache.prototype.store = function(key, value) {
	return false;
};

NullCache.prototype.remove = function(key) {
	return false;
}

// -------------------------------------------------------------

var MemoryCache = exports.MemoryCache = function() {
	Cache.call(this);
	this.storage = { };
}

MemoryCache.prototype = new Cache();

MemoryCache.prototype.lookup = function(key) {
	if (this.storage.hasOwnProperty(color)) {
		return this.storage[color];
	}
	return false;
};

MemoryCache.prototype.store = function(key, value) {
	this.storage[color] = imageBuffer;
};

MemoryCache.prototype.remove = function(key) {
	delete this.storage[key];
}

// -------------------------------------------------------------

var FileCache = exports.FileCache = function(filePath) {
	Cache.call(this);
	this.filePath = filePath;
}

FileCache.prototype.path = function() {
	var args = toArray(arguments);
	args.unshift(this.filePath);
	return path.join.apply(path, args);
};

FileCache.prototype.lookup = function(key) {
	key = this.path(key);

	var jsonFile = key + '.json';
	if (fs.existsSync(jsonFile)) {
		return JSON.parse(fs.readFileSync(jsonFile, 'utf8'));
	}

	var bufferFile = key + '.buffer';
	if (fs.existsSync(bufferFile)) {
		return fs.readFileSync(bufferFile);
	}

	return false;
};

FileCache.prototype.store = function(key, value) {
	if (Buffer.isBuffer(value)) {
		key += '.buffer';
	} else {
		key += '.json';
		value = JSON.stringify(value);
	}
	fs.writeFileSync(this.path(key), value);
};

FileCache.prototype.remove = function(key) {
	key = this.path(key);
	fs.unlink(key + '.json');
	fs.unlink(key + '.buffer');
};

// -------------------------------------------------------------

function toArray(arr) {
	return Array.prototype.slice.call(arr);
}
