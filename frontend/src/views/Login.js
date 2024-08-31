import React, { useState } from 'react';
import ApiUrl from '../ApiUrl';
import axios from 'axios';
import TextInput from '../components/input/TextInput';
import PasswordInput from '../components/input/PasswordInput';
import { Link } from 'react-router-dom';
import { useAlertProvider } from '../components/alert/AlertProvider';
import { AlertType } from '../components/alert/AlertType';
import Alert from '../components/alert/Alert';

export default function () {
  const [isLoading, setIsLoading] = useState(false)
  const [username, setUsername] = useState('')
  const [password, setPassword] = useState('')
  const [validationErrors, setValidationErrors] = useState(null)
  // alerts
  const { setAlert, clearAlert } = useAlertProvider()

  const login = async () => {
    clearAlert()
    setValidationErrors(null)

    axios.post(ApiUrl.LOGIN, {
      username: username,
      password: password,
    })
      .then(function (response) {
        const { data } = response
        // Success
        if (data.success) {
          setAlert('Successful login', AlertType.success)
        } else if (data.message) {
          setAlert(data.message, AlertType.warning)
        }
      })
      .catch(function (error) {
        if (error.response) {
          const { data, status } = error.response
          console.log(data)
          if (status === 400) {
            setValidationErrors(error.response.data.validation)
          } else {
            setAlert(data.error, AlertType.error)
          }
        }
      });
  }

  return (
    <div className="inline">
      <Alert />
      <div className="mb-1 text-2xl font-bold">Login</div>
      <div className="mb-6 text-xs text-gray-500">Password authentication</div>

      <TextInput value={username} onChange={setUsername} error={validationErrors?.username} />
      <PasswordInput value={password} onChange={setPassword} error={validationErrors?.password} />

      <button className="block mb-3 p-2 w-full text-white font-semibold bg-blue-500 rounded-lg border-[1px] border-blue-500" onClick={() => login()}>Login</button>
      <Link to='/login-face' className="block mb-3 p-2 w-full text-black font-semibold rounded-lg border-[1px] border-black text-center">Login with face</Link>

      <div className='my-10 text-center text-gray-500'>or</div>

      <button className="block mb-3 p-2 w-full text-black font-semibold rounded-lg border-[1px] border-black">Register</button>
    </div>
  );
};
