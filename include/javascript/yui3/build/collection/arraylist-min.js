/*
Copyright (c) 2010, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.com/yui/license.html
version: 3.3.0
build: 3167
*/
YUI.add("arraylist",function(e){var d=e.Array,c=d.each,a;function b(f){if(f!==undefined){this._items=e.Lang.isArray(f)?f:d(f);}else{this._items=this._items||[];}}a={item:function(f){return this._items[f];},each:function(g,f){c(this._items,function(j,h){j=this.item(h);g.call(f||j,j,h,this);},this);return this;},some:function(g,f){return d.some(this._items,function(j,h){j=this.item(h);return g.call(f||j,j,h,this);},this);},indexOf:function(f){return d.indexOf(this._items,f);},size:function(){return this._items.length;},isEmpty:function(){return !this.size();},toJSON:function(){return this._items;}};a._item=a.item;b.prototype=a;e.mix(b,{addMethod:function(f,g){g=d(g);c(g,function(h){f[h]=function(){var j=d(arguments,0,true),i=[];c(this._items,function(m,l){m=this._item(l);var k=m[h].apply(m,j);if(k!==undefined&&k!==m){i.push(k);}},this);return i.length?i:this;};});}});e.ArrayList=b;},"3.3.0");