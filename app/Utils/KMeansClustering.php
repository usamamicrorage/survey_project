<?php

namespace App\Utils;

class KMeansClustering
{
    protected $data;
    protected $clusters;
    protected $centroids;

    public function __construct(array $data, int $clusters = 2)
    {
        $this->data = $data;
        $this->clusters = $clusters;
        $this->centroids = $this->initializeCentroids();
    }

    // Initialize random centroids from the dataset
    private function initializeCentroids()
    {
        return array_slice($this->data, 0, $this->clusters);
    }

    // Calculate the Euclidean distance between two points
    private function calculateDistance($point1, $point2)
    {
        return sqrt(array_sum(array_map(function ($x, $y) {
            return pow($x - $y, 2);
        }, $point1, $point2)));
    }

    // Assign each point to the nearest centroid
    public function assignClusters()
    {
        $clusters = array_fill(0, $this->clusters, []);
        foreach ($this->data as $point) {
            $distances = array_map(fn($centroid) => $this->calculateDistance($centroid, $point), $this->centroids);
            $clusterIndex = array_search(min($distances), $distances);
            $clusters[$clusterIndex][] = $point;
        }
        $this->centroids = $this->recalculateCentroids($clusters);
        return $clusters;
    }

    // Recalculate centroids based on the assigned clusters
    private function recalculateCentroids($clusters)
    {
        return array_map(function ($cluster) {
            $count = count($cluster);
            if ($count == 0) return $cluster;
            $sum = array_reduce($cluster, function ($carry, $item) {
                return array_map(fn($x, $y) => $x + $y, $carry, $item);
            }, array_fill(0, count($cluster[0]), 0));
            return array_map(fn($x) => $x / $count, $sum);
        }, $clusters);
    }
}
