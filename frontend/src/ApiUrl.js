const API_URL = process.env.REACT_APP_API_URL

export default {
  BASE: API_URL,
  LOGIN: `${API_URL}/api/auth/login`,
  REGISTER: `${API_URL}/api/auth/register`,
  LOGOUT: `${API_URL}/api/auth/logout`,
  ME: `${API_URL}/api/users/me`,
}