
<?php
class SinglePackage
{
    private $category;
    private $packageType;
    private $packageName;
    private $vendorName;
    private $price;
    private $transportCost;
    private $availableStatus;
    private $image;
    private $rating;

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
    public function getPackageType()
    {
        return $this->packageType;
    }
    public function setPackageType($packageType)
    {
        $this->packageType = $packageType;

        return $this;
    }
    public function getPackageName()
    {
        return $this->packageName;
    }
    public function setPackageName($packageName)
    {
        $this->packageName = $packageName;

        return $this;
    }
    public function getVendorName()
    {
        return $this->vendorName;
    }
    public function setVendorName($vendorName)
    {
        $this->vendorName = $vendorName;

        return $this;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
    public function getTransportCost()
    {
        return $this->transportCost;
    }
    public function setTransportCost($transportCost)
    {
        $this->transportCost = $transportCost;

        return $this;
    }
    public function getAvailableStatus()
    {
        return $this->availableStatus;
    }
    public function setAvailableStatus($availableStatus)
    {
        $this->availableStatus = $availableStatus;

        return $this;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
    public function getRating()
    {
        return $this->rating;
    }
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }
    public function SinglePackage($category, $packageType, $packageName, $vendorName, $price, $transportCost, $availableStatus, $image, $rating)
    {
        $this->category = $category;
        $this->packageType = $packageType;
        $this->packageName = $packageName;
        $this->vendorName = $vendorName;
        $this->price = $price;
        $this->transportCost = $transportCost;
        $this->availableStatus = $availableStatus;
        $this->image = $image;
        $this->rating = $rating;
    }
}
