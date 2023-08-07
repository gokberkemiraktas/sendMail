<?php

namespace Models;

class MailData
{
    public ApplyType $applyType;

    public ?string $username;
    public ?bool $certificate;
    public ?string $phoneNumber;
    public ?bool $drivingLicense;

    public function setWithArray(array $data)
    {
        $apllyType = new ApplyType();
        $apllyType->id = $data["applyType"]["id"] ?? null;
        $apllyType->text = $data["applyType"]["text"] ?? null;
        $apllyType->icon = $data["applyType"]["icon"] ?? null;
        $this->applyType = $apllyType;
        $this->username = $data["username"] ?? null;
        $this->certificate = $data["certificate"] ?? null;
        $this->phoneNumber = $data["phoneNumber"] ?? null;
        $this->drivingLicense = $data["drivingLicense"] ?? null;
    }

    public function __toString(): string
    {
        return json_encode($this);
    }

    /**
     * @return string
     * this is return html template
     */
    public function getHtml(): string
    {
        //return html template
        $html = "<html><body>";

        $html .= "<h1>Apply Type: </h1>";
        foreach ($this->applyType as $key => $value) {
            $html .= "<h3>" . $key . ": " . $value . "</h3>";
        }
        $html .= "<br><hr><br>";
        $html .= "<h1>Username: " . $this->username . "</h1>";

        $cert = $this->certificate ? "true" : "false";

        $html .= "<h1>Certificate: " . $cert . "</h1>";
        $html .= "<h1>Phone Number: " . $this->phoneNumber . "</h1>";
        $driverLicense = $this->drivingLicense ? "true" : "false";
        $html .= "<h1>Driving License: " . $driverLicense . "</h1>";
        $html .= "</body></html>";
        return $html;
    }
}