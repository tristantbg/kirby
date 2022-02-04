export default (file, params) => {
  const defaults = {
    url: "/",
    field: "file",
    method: "POST",
    attributes: {},
    complete: function () {},
    error: function () {},
    success: function () {},
    progress: function () {}
  };

  const options = Object.assign(defaults, params);
  const sliceSize = 10000000; // Send 10MB Chunks

  function uploadFile(file) {
    console.log('Sending File of Size: ' + file.size);
    send(file, 0, sliceSize);
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

  function send(file, start, end) {
    let xhr = createXhr();
    let formData = createFormData();

    if (file.size - end < 0) { // Uses a closure on size here you could pass this as a param
      end = file.size;
    }

    if (end < file.size) {
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          console.log('Done Sending Chunk');
          send(file, start + sliceSize, start + (sliceSize * 2))
        }
      }
    } else {
      console.log('Upload complete');
    }

    let slicedPart = slice(file, start, end);

    formData.append('start', new File([start], file.name));
    formData.append('end', new File([end], file.name));
    formData.append(options.field, new File([slicedPart], file.name));
    console.log('Sending Chunk (Start - End): ' + start + ' ' + end);

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

  function slice(file, start, end) {
    let slice = file.mozSlice ? file.mozSlice :
      file.webkitSlice ? file.webkitSlice :
        file.slice ? file.slice : noop;

    return slice.bind(file)(start, end);
  }

  function noop() {
  }
};
