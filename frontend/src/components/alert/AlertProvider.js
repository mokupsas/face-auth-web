import React, { createContext, useContext, useState } from 'react';
import { AlertType } from './AlertType';

const AlertContext = createContext();

export const useAlertProvider = () => useContext(AlertContext);

export const AlertProvider = ({ children }) => {
  const [message, setMessage] = useState(null)
  const [type, setType] = useState(null)

  const setAlert = (message, type, timeout = 0) => {
    if (!validateType(type)) {
      console.error('Invalid alert type: ' + type)
      return
    }

    setMessage(message)
    setType(type)

    if (timeout && timeout > 0) {
      setTimeout(() => {
        setMessage(null)
        setType(null)
      }, timeout)
    }
  };

  const clearAlert = () => {
    setMessage(null)
    setType(null)
  };

  const validateType = (type) => {
    switch (type) {
      case AlertType.success:
        return true
      case AlertType.info:
        return true
      case AlertType.warning:
        return true
      case AlertType.error:
        return true
      default:
        return false
    }
  }

  return (
    <AlertContext.Provider value={{ setAlert, clearAlert, message, type }}>
      {children}
    </AlertContext.Provider>
  );
};