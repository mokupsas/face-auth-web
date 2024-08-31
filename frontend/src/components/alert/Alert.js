import AlertMui from '@mui/material/Alert';
import { useAlertProvider } from './AlertProvider';

export default function () {
    const { message, type } = useAlertProvider()

    return (
        <>
            {message ?
                <div className='mb-3 w-full z-10'>
                    <AlertMui severity={type}>{message}</AlertMui>
                </div>
                : null}
        </>
    );
};
