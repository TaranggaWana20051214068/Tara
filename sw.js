const cacheName = "tara-v1.2";
const preCache = [
  "/",
  "/registrasi.php",
  "/home.php",
  "/logout.php",
  "/offline.html",
  "/js/script.js",
];

self.addEventListener("install", function (event) {
  event.waitUntil(
    caches.open(cacheName).then(function (cache) {
      console.log("in install serviceWorker.. cache opened!");
      return cache.addAll(preCache);
    })
  );
});

self.addEventListener("activate", function (event) {
  event.waitUntil(
    caches.keys().then(function (cacheNames) {
      return Promise.all(
        cacheNames
          .filter(function (cacheNamed) {
            return cacheNamed != cacheName;
          })
          .map(function (cacheNamed) {
            return caches.delete(cacheNamed);
          })
      );
    })
  );
});

self.addEventListener("fetch", function (event) {
  var request = event.request;
  var url = new URL(request.url);

  // pisahkan request API dan Internal
  if (url.origin === location.origin) {
    event.respondWith(
      caches.match(request).then(function (response) {
        return response || fetch(request);
      })
    );
  } else {
    event.respondWith(
      caches.open("produk-cache").then(function (cache) {
        return fetch(request)
          .then(function (liveResponse) {
            cache.put(request, liveResponse.clone());
            return liveResponse;
          })
          .catch(function () {
            return caches.match(request).then(function (response) {
              if (response) return response;
              return caches.match("/offline.html");
            });
          });
      })
    );
  }
});
