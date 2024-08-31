import { TextField } from "@mui/material";
import React from "react";

export default function ({ value, onChange, error }) {
  return (
    <TextField
      id="standard-basic"
      label="Username"
      variant="standard"
      fullWidth
      style={{ marginBottom: 15 }}
      value={value}
      onChange={(e) => onChange(e.target.value)}
      error={error ? true : false}
      helperText={error ? error : null}
    />
  );
};
