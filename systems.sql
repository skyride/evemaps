SELECT mapSolarSystems.solarSystemID, solarSystemName, constellationName, regionName, mapSolarSystems.x, mapSolarSystems.y, mapSolarSystems.z, security
FROM mapSolarSystems
INNER JOIN mapRegions ON mapSolarSystems.regionID=mapRegions.regionID
INNER JOIN mapConstellations ON mapSolarSystems.constellationID=mapConstellations.constellationID

WHERE mapSolarSystems.regionID < 11000001
/*AND regionName != 'UUA-F4'
AND regionName != 'A821-A'
AND regionName != 'J7HZ-F'*/
