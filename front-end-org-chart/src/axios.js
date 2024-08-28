import axios from 'axios'

const instance = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/v1', // Replace with your API base URL
  timeout: 10000, // Optional: Request timeout
  headers: { 'Content-Type': 'application/json' }
})

export default instance
