import { Outlet } from "react-router-dom";

export default function () {
  return (
    <div className="flex min-h-dvh justify-center items-center">
      <div className="mx-auto my-10 w-96">
        <Outlet />
      </div>
    </div>
  );
};
