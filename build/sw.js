importScripts('workbox-sw.prod.v2.1.2.js');

/**
 * DO NOT EDIT THE FILE MANIFEST ENTRY
 *
 * The method precache() does the following:
 * 1. Cache URLs in the manifest to a local cache.
 * 2. When a network request is made for any of these URLs the response
 *    will ALWAYS comes from the cache, NEVER the network.
 * 3. When the service worker changes ONLY assets with a revision change are
 *    updated, old cache entries are left as is.
 *
 * By changing the file manifest manually, your users may end up not receiving
 * new versions of files because the revision hasn't changed.
 *
 * Please use workbox-build or some other tool / approach to generate the file
 * manifest which accounts for changes to local files and update the revision
 * accordingly.
 */
const fileManifest = [
  {
    "url": "critical-about.css",
    "revision": "4a6e2091235cf9e27d6b0a945b76768a"
  },
  {
    "url": "critical-blog.css",
    "revision": "5acf2f36cf7f5f198c595c0154727dfa"
  },
  {
    "url": "critical-gallery.css",
    "revision": "f933175bf06a50cf53db9bbb06d984a0"
  },
  {
    "url": "critical-home.css",
    "revision": "a1999fe077d72324a394050956f771b6"
  },
  {
    "url": "critical-landing.css",
    "revision": "219d44b7bf8478564077d801359c6b4b"
  },
  {
    "url": "critical-photos.css",
    "revision": "79f89ff764b6f22fed69d32433f2e01d"
  },
  {
    "url": "style.css",
    "revision": "36c93fadb2b13983aea8b5474e141b30"
  }
];

const workboxSW = new self.WorkboxSW();
workboxSW.precache(fileManifest);
