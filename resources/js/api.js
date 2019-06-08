import axios from "axios";

const baseURL = process.env.MIX_ENDPOINT_URL;

let token = document.head.querySelector('meta[name="csrf-token"]');

export default axios.create({
  baseURL,
  headers: {
    "X-Requested-With": "XMLHttpRequest",
    "X-CSRF-TOKEN": token.content,
  },
  responseType: "json",
});
