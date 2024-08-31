import React, { useState } from 'react';
import ApiUrl from '../ApiUrl';
import axios from 'axios';
import TextInput from '../components/input/TextInput';
import PasswordInput from '../components/input/PasswordInput';
import { Link } from 'react-router-dom';
import Webcam from 'react-webcam';

export default function () {
  const [isLoading, setIsLoading] = useState(false)
  const [username, setUsername] = useState('')
  const [password, setPassword] = useState('')
  const [validationErrors, setValidationErrors] = useState(null)

  const webcamRef = React.useRef(null);
  const capture = React.useCallback(
    () => {
      const imageSrc = webcamRef.current.getScreenshot();
    },
    [webcamRef]
  );

  const WebcamComponent = () => <Webcam />;
  const videoConstraints = {
    width: 1280,
    height: 720,
    facingMode: "user"
  };

  const login = async () => {
    setValidationErrors(null)
  }

  return (
    <div className="inline">
      <div className="mb-1 text-2xl font-bold">Login</div>
      <div className="mb-6 text-xs text-gray-500">Face authentication</div>

      <div className='relative mx-auto flex justify-center'>
        <Webcam
          audio={false}
          height={720}
          ref={webcamRef}
          screenshotFormat="image/jpeg"
          width={1280}
          videoConstraints={videoConstraints}
          className='z-10 mb-3 h-64 w-64 rounded-full object-cover'
          mirrored
        />
        <div className='z-0 absolute top-0 mx-auto bg-gray-300 h-64 w-64 rounded-full justify-center flex items-center text-6xl text-gray-500'>
          <i class="fa-solid fa-camera"></i>
        </div>
      </div>

      <button className="block mb-3 p-2 w-full text-white font-semibold bg-blue-500 rounded-lg border-[1px] border-blue-500" onClick={() => login()}>Login</button>
      <Link to='/login' className="block mb-3 p-2 w-full text-black font-semibold rounded-lg border-[1px] border-black text-center">Login with password</Link>

      <div className='my-10 text-center text-gray-500'>or</div>

      <button className="block mb-3 p-2 w-full text-black font-semibold rounded-lg border-[1px] border-black">Register</button>
    </div>
  );
};
