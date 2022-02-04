export default (file, params) => {
  const defaults = {
    url: "/",
    field: "file",
    method: "POST",
    headers: {
      'Content-Type': 'application/octet-stream'
    },
    attributes: {},
    complete: function () {},
    error: function () {},
    success: function () {},
    progress: function () {}
  };

  let chunks = [];
  const options = Object.assign(defaults, params);
  const sliceSize = 10000000; // Send 10MB Chunks

  function uploadFile(file) {
    console.log('Sending File of Size: ' + file.size);
    createChunks(file);
    send(file);
  }

  function createChunks(file) {
    let size = 2048, parts = Math.ceil(file.size / size);

    for (let i = 0; i < parts; i++) {
      chunks.push(file.slice(
        i * size, Math.min(i * size + size, file.size), file.type
      ));
    }
  }

  function createFormData() {
    const formData = new FormData();

    formData.append(options.field, file, file.name);

    if (options.attributes) {
      Object.keys(options.attributes).forEach((key) => {
        formData.append(key, options.attributes[key]);
      });
    }

    return formData;
  }

  function createXhr() {
    const xhr = new XMLHttpRequest();

    const progress = (event) => {
      if (!event.lengthComputable || !options.progress) {
        return;
      }

      let percent = Math.max(
        0,
        Math.min(100, (event.loaded / event.total) * 100)
      );

      options.progress(xhr, file, Math.ceil(percent));
    };

    xhr.upload.addEventListener("loadstart", progress);
    xhr.upload.addEventListener("progress", progress);

    xhr.addEventListener("load", (event) => {
      let json = null;

      try {
        json = JSON.parse(event.target.response);
      } catch (e) {
        json = {status: "error", message: "The file could not be uploaded"};
      }

      if (json.status === "error") {
        options.error(xhr, file, json);
      } else {
        options.success(xhr, file, json);
        options.progress(xhr, file, 100);
      }
    });

    xhr.addEventListener("error", (event) => {
      const json = JSON.parse(event.target.response);

      options.error(xhr, file, json);
      options.progress(xhr, file, 100);
    });

    return xhr;
  }

  function send(file) {
    let xhr = createXhr();
    let formData = createFormData();

    if (chunks.length > 0) {
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          console.log('Done Sending Chunk');
          chunks.shift();
          send(file);
        }
      }
    } else {
      console.log('Upload complete');
    }

    formData.set('is_last', chunks.length === 1);
    formData.set(options.field, chunks[0], file.name + ".part");
    console.log('Sending Chunk');

    xhr.open(options.method, options.url, true);

    // add all request headers
    if (options.headers) {
      Object.keys(options.headers).forEach((header) => {
        const value = options.headers[header];
        xhr.setRequestHeader(header, value);
      });
    }

    xhr.send(formData);
  }
};
