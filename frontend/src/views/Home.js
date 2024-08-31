import { useEffect } from "react";
import { useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";

export default function () {
  const navigate = useNavigate();
  const username = useSelector((state) => state.user.username)

  return (
    <div>Home a</div>
  );
};
