/**
 * Minified by jsDelivr using Terser v5.3.5.
 * Original file: /npm/livewire@0.6.1/lib/compiler.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
(function(){var e,r,n,t=[].slice;e=require("highland"),r=require("url").parse,n=function(e){return e[e.length-1]},exports.compilePath=function(u){var a,i,c;return"[a-z$_][a-z0-9$_]*",":",a=[],i=u.replace(RegExp(":([a-z$_][a-z0-9$_]*)","ig"),(function(e,r){return a.push(r),"([^\\/]+)"})),c=function(){switch(!1){case"/"!==u:return/^\/$/;case"/"!==n(u):return RegExp("^"+i+"?","i");default:return RegExp("^"+i+"\\/?$","i")}}(),function(n){var u,i,l,o,f;return u=r(n).pathname,null!=(i=c.exec(u))?(i[0],l=t.call(i,1),e([function(){var e,r,n,t={};for(e=0,n=(r=l).length;e<n;++e)o=e,f=r[e],t[a[o]]=f;return t}()])):e([])}}}).call(this);
//# sourceMappingURL=/sm/e5d2460ab7ed9d13533a3366c6ef56d7405ebd55e7f83a0f4aba68ee651aec44.map