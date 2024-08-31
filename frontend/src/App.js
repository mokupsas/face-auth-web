import { Routes, Route } from "react-router-dom";
import { createTheme, ThemeProvider } from '@mui/material/styles';
import { AlertProvider } from './components/alert/AlertProvider';
// Layouts
import MainLayout from "./layouts/MainLayout";
import AuthLayout from "./layouts/AuthLayout";
// Views
import Home from "./views/Home";
import Login from "./views/Login";
import Register from "./views/Register";
import LoginFace from "./views/LoginFace";
import axios from "axios";

function App() {
  axios.defaults.withCredentials = true

  const THEME = createTheme({
    typography: {
      "fontFamily": `"Roboto", "Helvetica", "Arial", sans-serif`,
    }
  });

  return (
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
  );
}

export default App;
