<?php

namespace ByTestGear\ActiveCampaign\Actions;

use ByTestGear\ActiveCampaign\Resources\Organization;

trait ManagesOrganizations
{
    /**
     * Get all organizations.
     *
     * @return array
     */
    public function organizations()
    {
        return $this->transformCollection(
            $this->get('organizations'),
            Organization::class,
            'organizations'
        );
    }

    /**
     * Find organization by name.
     *
     * @param string $name
     *
     * @return array
     */
    public function findOrganization($name)
    {
        $organizations = $this->transformCollection(
            $this->get('organizations', ['query' => ['filters' => ['name' => $name]]]),
            Organization::class,
            'organizations'
        );

        return array_shift($organizations);
    }

    /**
     * Create new organization.
     *
     * @param array $data
     *
     * @return Organization
     */
    public function createOrganization(array $data = [])
    {
        $organizations = $this->transformCollection(
            $this->post('organizations', ['json' => ['organization' => $data]]),
            Organization::class
        );

        return array_shift($organizations);
    }

    /**
     * Find or create an organization.
     *
     * @param $name
     *
     * @return Organization
     */
    public function findOrCreateOrganization($name)
    {
        $organization = $this->findOrganization($name);

        if ($organization instanceof Organization) {
            return $organization;
        }

        return $this->createOrganization(['name' => $name]);
    }
}
