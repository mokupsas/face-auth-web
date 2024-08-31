import { Routes, Route, useNavigate } from "react-router-dom";
import { createTheme, ThemeProvider } from '@mui/material/styles';
import { AlertProvider } from './components/alert/AlertProvider';
import { Provider } from 'react-redux'
import store from './store'
// Layouts
import MainLayout from "./layouts/MainLayout";
import AuthLayout from "./layouts/AuthLayout";
// Views
import Home from "./views/Home";
import Login from "./views/Login";
import Register from "./views/Register";
import LoginFace from "./views/LoginFace";
import axios from "axios";
import ApiUrl from "./ApiUrl";
import { setUser } from "./store/user";
import { useEffect, useState } from "react";

function App() {
  const [ready, setReady] = useState(false)
  const navigate = useNavigate();

  axios.defaults.withCredentials = true

  const THEME = createTheme({
    typography: {
      "fontFamily": `"Roboto", "Helvetica", "Arial", sans-serif`,
    }
  });

  const fetchUserData = async () => {
    axios.get(ApiUrl.ME)
      .then(function (response) {
        const { data } = response
        // Success
        if (data) {
          console.log(data)
          store.dispatch(setUser(data))
        }
      })
      .catch(function (error) {
        navigate('/login')
      })
      .finally(() => setReady(true));
  }

  useEffect(() => {
    fetchUserData()
  }, [])

  if (!ready)
    return

  return (
    <Provider store={store}>
      <AlertProvider>
        <ThemeProvider theme={THEME}>
          <Routes>
            <Route path="/" element={<MainLayout />}>
              <Route path="/" element={<Home />} />
            </Route>
            <Route element={<AuthLayout />}>
              <Route path="/login" element={<Login />} />
              <Route path="/login-face" element={<LoginFace />} />
              <Route path="/register" element={<Register />} />
            </Route>
          </Routes>
        </ThemeProvider>
      </AlertProvider>
    </Provider>
  );
}

export default App;
