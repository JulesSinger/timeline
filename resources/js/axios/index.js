import axios from "axios"
import store from "../store"

const axiosClient = axios.create({
  baseURL: 'http://127.0.0.1:8000',
  headers: {
    'Accept' : 'application/json',
    'Content-Type' : 'application/json',
    'Authorization': `Bearer ${store.state.auth.token}`
  }
})


export default axiosClient